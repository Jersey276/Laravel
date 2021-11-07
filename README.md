# New-Laravel-Blog

A laravel website for present myself. This website can be used for a people, a group, ...

## Fonctionnality

This website can do :

- blog system, with post and command
- project display, and editor
- authentification system

## Authentification / Authorization system

This project use all existing Laravel Auth system for user Register / Login / Reset password / Verify email.
Mail can be send when user register and ask for reset password. Mail design is Laravel standard mail design.

Authorization use policies system for post only. A custom role/rule system let administrator create role for specific user and affect custom authorization with specific rule. Rule are created with rules middleware and are automatically created at navigation. All created rules are automatically affected to "admin" roles.

## Blog system

Authorized user
