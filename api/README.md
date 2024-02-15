README.md

Vercel PATH = /var/task/user/api/README.md

php.ini
	curl.cainfo="/var/task/user/cacert.pem"
	openssl.cafile="/var/runtime/ca-cert.pem"
database.php redis
            'scheme' => 'tls',
            'read_timeout' => 600,
            'timeout' => 600,