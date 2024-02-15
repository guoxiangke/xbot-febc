README.md

Vercel PATH = /var/task/user/api/README.md

php.ini
	curl.cainfo="/var/task/user/cacert.pem"
	openssl.cafile="/var/runtime/ca-cert.pem"
database.php redis
            'scheme' => 'tls',
            'read_timeout' => 600,
            'timeout' => 600,

Vercel.json
        "api/index.php": {
            "runtime": "vercel-php@0.5.4",
            "memory": 3008,
            "maxDuration": 180
        }

https://vercel.com/docs/functions/runtimes#file-system-support