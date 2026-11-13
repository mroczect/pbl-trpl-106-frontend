# pbl-trpl-106-frontend

frontend source code for project-based learning

---

## Installasi

untuk instalasi simpel aja cukup siapkan php aja udah bisa senenrnya dan kalau udah tinggal verifikasi dulu phpnya ini udha bisa di run atau ngak.

cara verifikasi php udah ke install atau belum

```sh
$ php --verison
```

output nya

```txt
PHP 8.5.12 (cli) (built: Oct 19 2026 17:02:46) (NTS gcc x86_64)
Copyright (c) The PHP Group
Built by Fedora Project
Zend Engine v4.5.12, Copyright (c) Zend Technologies
    with Zend OPcache v8.5.12, Copyright (c), by Zend Technologies
```

kalok belum tinggal instal, aja,

1. windows : `choco install php`
2. macOS : `brew install php`
3. linux : `sudo apt install php php-cli` atau sesuai disor aja cairk aja sendiri.

---

## Cara run

nah cara runya gampang aja kalau ada `Makefile` tinggal

```sh
$ make serve`
```

kalau ga ada juga ga apa apa tinggal run aja

```sh
$ php -S localhost:8000 -t src
```

udah gitu aja.
