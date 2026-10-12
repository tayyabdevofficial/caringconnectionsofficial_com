# CloudPanel Automated Deployment Guide: Caring Connections

This guide provides step-by-step instructions to deploy **Caring Connections** on **CloudPanel** with automated continuous deployment on every `git push origin main`.

---

## Site Details
* **Domain**: `caringconnectionsofficial.com`
* **Site User**: `caringconnectionsofficial`
* **Project Directory**: `/home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com`
* **Document Root**: `/home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com/public`
* **GitHub Repository**: `https://github.com/tayyabdevofficial/caringconnectionsofficial_com.git`
* **Branch**: `main`

---

## Step 1: Create the Site in CloudPanel

1. Log into your CloudPanel Dashboard (`https://<your-vps-ip>:8443`).
2. Go to **Sites** → **Add Site** → **Create a PHP Site**.
3. Fill in the site details:
   * **Domain Name**: `caringconnectionsofficial.com`
   * **Site User**: `caringconnectionsofficial`
   * **App / Framework**: `Laravel` (or standard PHP)
   * **PHP Version**: `8.2` or `8.3`
   * **Document Root**: Enter `/home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com/public`
4. Click **Create**.
5. Go to **SSL/TLS** tab for the site and click **New Let's Encrypt Certificate** to enable HTTPS.

---

## Step 2: Configure SSH Deploy Key for GitHub

To allow your server to pull private repository code automatically:

1. In your VPS terminal (as `root`), switch to the site user:
   ```bash
   su - caringconnectionsofficial
   ```
2. Generate an SSH deploy key:
   ```bash
   ssh-keygen -t ed25519 -C "deploy@caringconnectionsofficial.com" -f ~/.ssh/id_ed25519 -N ""
   ```
3. Display the public key:
   ```bash
   cat ~/.ssh/id_ed25519.pub
   ```
4. Copy the entire output (`ssh-ed25519 AAAA...`).
5. Go to your GitHub repository:
   * **Settings** → **Deploy keys** → **Add deploy key**
   * Title: `CloudPanel VPS`
   * Key: Paste the copied public key.
   * Allow write access: *Leave unchecked (read-only is sufficient).*
   * Click **Add key**.
6. Test GitHub SSH connection from your VPS:
   ```bash
   ssh -T git@github.com
   ```
   *(Type `yes` when prompted to verify the host key. You should see: "Hi tayyabdevofficial/caringconnectionsofficial_com! You've successfully authenticated...")*

---

## Step 3: Initial Code Clone & Setup

Still as user `caringconnectionsofficial` on the server:

```bash
# 1. Navigate to the htdocs root
cd /home/caringconnectionsofficial/htdocs

# 2. Back up any default dummy directory created by CloudPanel
mv caringconnectionsofficial.com caringconnectionsofficial.com.bak 2>/dev/null || true

# 3. Clone your GitHub repository
git clone git@github.com:tayyabdevofficial/caringconnectionsofficial_com.git caringconnectionsofficial.com

# 4. Enter the project directory
cd caringconnectionsofficial.com

# 5. Create your .env file
cp .env.example .env

# 6. Install Composer dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# 7. Generate application key
php artisan key:generate

# 8. Create storage symlink
php artisan storage:link
```

---

## Step 4: Configure Database & `.env`

1. In CloudPanel, go to **Databases** → **Add Database**.
   * **Database Name**: e.g., `caringconnections_db`
   * **User**: e.g., `caringconnections_usr`
   * Set a strong password and save.
2. Edit `/home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com/.env`:
   ```bash
   nano .env
   ```
3. Set your production settings:
   ```env
   APP_NAME="Caring Connections"
   APP_ENV=production
   APP_KEY=base64:...
   APP_DEBUG=false
   APP_URL=https://caringconnectionsofficial.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=caringconnections_db
   DB_USERNAME=caringconnections_usr
   DB_PASSWORD=YourSecurePasswordHere
   ```
4. Run migrations:
   ```bash
   php artisan migrate --force
   ```

---

## Step 5: Create the Production `deploy.sh` Script

Create the automated deployment script inside the project directory:

```bash
nano /home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com/deploy.sh
```

Paste the following script:

```bash
#!/bin/bash
set -e

APP_DIR="/home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com"
cd "$APP_DIR"

# Ensure global Node and NPM binaries are in PATH
export PATH="$APP_DIR/node_modules/.bin:/usr/local/bin:/usr/bin:/bin:$PATH"

echo "=== [$(date)] Deployment Started ==="
echo "User: $(whoami)"
echo "Node: $(node -v 2>/dev/null || echo 'not found')"
echo "NPM:  $(npm -v 2>/dev/null || echo 'not found')"

echo "=== Fetching latest code ==="
git fetch origin main
git reset --hard origin/main

echo "=== Installing Composer dependencies ==="
composer install \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction

echo "=== Installing frontend dependencies ==="
npm ci --include=dev

echo "=== Verifying Vite installation ==="
test -f node_modules/vite/bin/vite.js || {
    echo "ERROR: Vite binary missing after npm ci"
    exit 1
}

echo "=== Building production assets ==="
node node_modules/vite/bin/vite.js build

echo "=== Running database migrations ==="
php artisan migrate --force

echo "=== Clearing and rebuilding Laravel caches ==="
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Restarting queue workers ==="
php artisan queue:restart || true

echo "=== [$(date)] Deployment completed successfully ==="
```

Make the script executable:
```bash
chmod +x /home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com/deploy.sh
```

Test it manually once:
```bash
bash /home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com/deploy.sh
```

---

## Step 6: Setup GitHub Auto-Deploy Webhook

To trigger `deploy.sh` automatically whenever code is pushed to GitHub:

### Option A: Lightweight Webhook Handler (Recommended)

1. Create a secure webhook script in `public/deploy-webhook.php`:
   ```bash
   nano /home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com/public/deploy-webhook.php
   ```
2. Paste the following PHP script (replace `YOUR_RANDOM_SECRET_KEY` with a strong random string):

   ```php
   <?php
   // Secure GitHub Webhook Receiver
   $secret = 'YOUR_RANDOM_SECRET_KEY';

   $signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
   $payload = file_get_contents('php://input');

   if (!$signature || !$payload) {
       http_response_code(400);
       die('Bad Request');
   }

   $expected = 'sha256=' . hash_hmac('sha256', $payload, $secret);

   if (!hash_equals($expected, $signature)) {
       http_response_code(403);
       die('Invalid signature');
   }

   $data = json_decode($payload, true);

   // Only deploy pushes to main branch
   if (($data['ref'] ?? '') === 'refs/heads/main') {
       $cmd = 'bash /home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com/deploy.sh > /home/caringconnectionsofficial/deploy.log 2>&1 &';
       shell_exec($cmd);
       echo json_encode(['status' => 'deploy_triggered', 'time' => date('Y-m-d H:i:s')]);
   } else {
       echo json_encode(['status' => 'ignored', 'ref' => $data['ref'] ?? '']);
   }
   ```

3. Save and close. Ensure correct ownership:
   ```bash
   chown caringconnectionsofficial:caringconnectionsofficial /home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com/public/deploy-webhook.php
   chmod 644 /home/caringconnectionsofficial/htdocs/caringconnectionsofficial.com/public/deploy-webhook.php
   ```

4. Add the Webhook to GitHub:
   * Open your GitHub repository: `https://github.com/tayyabdevofficial/caringconnectionsofficial_com`
   * Go to **Settings** → **Webhooks** → **Add webhook**
   * **Payload URL**: `https://caringconnectionsofficial.com/deploy-webhook.php`
   * **Content type**: `application/json`
   * **Secret**: Enter the exact secret string you put in `deploy-webhook.php` (`YOUR_RANDOM_SECRET_KEY`)
   * **Which events would you like to trigger this webhook?**: Select **Just the push event**
   * Check **Active**
   * Click **Add webhook**

---

## Step 7: Verify Everything Works

1. On your local machine, make a test commit and push:
   ```bash
   git commit -m "Test automated CloudPanel deployment"
   git push origin main
   ```
2. On your VPS, monitor the live deployment log:
   ```bash
   tail -f /home/caringconnectionsofficial/deploy.log
   ```
3. In GitHub, check **Settings → Webhooks → Recent Deliveries** — you should see a `200 OK` green checkmark.
4. Visit `https://caringconnectionsofficial.com` — the updated code and compiled Vite assets will be live immediately!
