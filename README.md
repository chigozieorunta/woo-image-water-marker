# Woo Image Water Marker

A simple plugin to help you insert water markers into WooCommerce product images.

## Screenshots

![alt text](https://github.com/chigozieorunta/woo-image-water-marker/blob/master/screenshots/screenshot-1.png)

## Requirements

- WordPress 5.0+
- WooCommerce
- PHP 7.2 or later
- [Composer](https://getcomposer.org) and [Node.js](https://nodejs.org) for dependency management.
- [Docker](https://docs.docker.com/install/) for a local development environment.

## Quick Setup

To get your development environment set up very quickly, follow the steps below:

1. Install Dependencies (Composer & Node).

```
npm run dev
```

2. Spin up Local dev server [http://localhost:4096](http://localhost:4096).

```
npm start
```

## Development

This repository includes a WordPress development environment based on [Docker](https://docs.docker.com/install/) that can be run on your computer like so:

1. Clone the plugin repository.

```
git clone https://github.com/chigozieorunta/quizzo
```

2. Run Composer [Composer](https://getcomposer.org).

```
composer install
```

3. Run Node [Node.js](https://nodejs.org).

```
npm install
```

4. To spin up your local development environment, run:

```
docker-compose up -d
```

which will make it available at [http://localhost:4096](http://localhost:4096)
