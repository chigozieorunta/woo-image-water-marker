# Contributing

First, thank you for taking the time to contribute!

The following is a set of guidelines for contributors as well as information and instructions around our maintenance process. The two are closely tied together in terms of how we all work together and set expectations, so while you may not need to know everything in here to submit an issue or pull request, it's best to keep them in the same document.

## Ways to contribute

Contributing isn't just writing code - it's anything that improves the project.  All contributions are managed right here on GitHub.  Here are some ways you can help:

### Reporting bugs

If you're running into an issue, please take a look through [existing issues](https://github.com/chigozieorunta/woo-image-water-marker/issues) and [open a new one](https://github.com/chigozieorunta/woo-image-water-marker/issues/new) if needed.  If you're able, include steps to reproduce, environment information, and screenshots/screencasts as relevant.

### Suggesting enhancements

New features and enhancements are also managed via [issues](https://github.com/chigozieorunta/woo-image-water-marker/issues).

### Pull requests

Pull requests represent a proposed solution to a specified problem.  They should always reference an issue that describes the problem and contains discussion about the problem itself. Discussion on pull requests should be limited to the pull request itself, i.e. code review.

## Workflow

The `develop` branch is the development branch which means it contains the next version to be released. The `master` branch contains the corresponding stable development version. Always work on the `develop` branch and open up PRs against `develop`.

### Branching strategy

- For Hotfixes - hotfix/<branch_name>
- For Features - feat/<branch_name>
- For Fixes - fix/<branch_name>

### Prerequisites

- WordPress 5.0+
- WooCommerce
- PHP 7.2 or later
- [Composer](https://getcomposer.org) and [Node.js](https://nodejs.org) for dependency management.
- [Docker](https://docs.docker.com/install/) for a local development environment.

### Getting Started

This repository includes a WordPress development environment based on [Docker](https://docs.docker.com/install/) that can be run on your computer like so:

1. Clone the plugin repository.

```
git clone https://github.com/chigozieorunta/woo-image-water-marker
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
