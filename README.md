PHPatch
=======

A tool for patching PHP files.

This project is work in progress.

The goal is to:
  - use a plugable architecture like PHPCS
  - use plugins for both detecting problems and fixing them
  - do all this work based on a stream of tokens, never string replacement
  - also allow patches like:
      - creating classes
      - implementing interfaces
      - implementing missing methods


