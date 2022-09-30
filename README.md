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

## Development

This repository includes a WordPress development environment based on [Docker](https://docs.docker.com/install/) that can be run on your computer like so:

1. Clone the plugin repository.

2. Setup the development environment and tools using [Node.js](https://nodejs.org) and [Composer](https://getcomposer.org):

```
npm install
```

Note that both Node.js and PHP 7.2 or later are required on your computer for running the `npm` scripts. Use `npm run docker -- npm install` to run the installer inside a Docker container if you don't have the required version of PHP installed locally.

3. To spin up your local development environment, run:

```
docker-compose up -d
```

which will make it available at [http://localhost:9999](http://localhost:9999)
