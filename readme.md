# Andesite Project

## Prepare your environment

### 1. Fontawesome

If you are paid customer of fontawesome, you should add your auth token to npm

`npm config set "@fortawesome:registry" https://npm.fontawesome.com/`

`npm config set "//npm.fontawesome.com/:_authToken" [token]`

Otherwise after installation, you should modify the `package.json` from `"@fortawesome/fontawesome-pro"` to `"@fortawesome/fontawesome-free"`


### 2. Install andesite cli

`composer global require andesite/cli`

add composer bin dir to your path (`~/.composer/vendor/bin`)

`export PATH=$PATH:~/.composer/vendor/bin`

### 3. Install rlogtail

`npm install -g rlogtail`


## Create your new andesite project

### 1. Create the project
`composer create-project andesite/project yourproject`

`cd yourproject`

### 2. Install npm packages

Modify the package.json if neccessary (fontawesome), then

`npm install`

### 3. Database

Create a mysql database for the project

### 4. Set the env.yml

Modify the `env.yml` in your project root. Uncomment the first 3 lines and

- set your domain
- set your db access
- set some thumbnail secret

### 5. Generate the env cache

`andesite env`

### 6. Turn on devmode

`andesite devmode`

### 7. Launch rlogtail

This is the error console for the andesite applications

`npm run tail`

### 8. Create the required folders

`andesite md`

### 9. Generate the vhost files

`andesite vhost`

### 10. Setup apache
Include the `virtualhost.conf` file created in `app/var` into your `httpd.conf`, then restart apache!

### 11. Setup default database

Initialize the migration engine

`andesite mig:init`

Run the first migration to have a user table, with a default user

`andesite mig:go`

### 12. Run live frontend build

`npm run work`

### 13. Test your app

- website: `yourdomain.test`
- admin: `admin.yourdomain.test` (spock@vulcan.hu/spock2355)
