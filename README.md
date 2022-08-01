## start 

```
php -S 127.0.0.1:8080
```
## request


for get request 

```
curl  http://localhost:8080/index.php/numbers/list\?limit\=20  
```

for post request 

```
curl --location --request POST 'http://localhost:8080/index.php/numbers/post' \
--form 'number="150"'
```
