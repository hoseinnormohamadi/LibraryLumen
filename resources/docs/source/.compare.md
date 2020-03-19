---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_a05a84f0145bd0b79f75c48449954129 -->
## /health
> Example request:

```bash
curl -X GET \
    -G "http://localhost/health" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/health"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (222):

```json
{
    "result": "ok"
}
```

### HTTP Request
`GET /health`


<!-- END_a05a84f0145bd0b79f75c48449954129 -->

<!-- START_7399ef9ba1fc7b4d7e6eae92c1cb795b -->
## /api/v1
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "code": 200,
    "message": "شما دسترسی به این بخش را ندارید",
    "object": null
}
```

### HTTP Request
`GET /api/v1`


<!-- END_7399ef9ba1fc7b4d7e6eae92c1cb795b -->

<!-- START_35ebad27b73d83fe8d230bfdd2693cea -->
## /api/v1/users
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/users" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/users"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "code": 200,
    "message": "شما دسترسی به این بخش را ندارید",
    "object": null
}
```

### HTTP Request
`GET /api/v1/users`


<!-- END_35ebad27b73d83fe8d230bfdd2693cea -->

<!-- START_722fd76c6f2e82e52d91890cad3888f0 -->
## /api/v1/Login
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/Login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/Login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /api/v1/Login`


<!-- END_722fd76c6f2e82e52d91890cad3888f0 -->

<!-- START_f9cd86b958963981e75f169d1affdc08 -->
## /api/v1/Register
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/Register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/Register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /api/v1/Register`


<!-- END_f9cd86b958963981e75f169d1affdc08 -->

<!-- START_4177d627b49659b6fb8b2a9be37ba445 -->
## /api/v1/MyBooks
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/MyBooks" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/MyBooks"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "code": 200,
    "message": "شما دسترسی به این بخش را ندارید",
    "object": null
}
```

### HTTP Request
`GET /api/v1/MyBooks`


<!-- END_4177d627b49659b6fb8b2a9be37ba445 -->

<!-- START_2ab33489e7fcc03c8e921d05f0b3db39 -->
## /api/v1/Book
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/Book" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/Book"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "code": 200,
    "message": "شما دسترسی به این بخش را ندارید",
    "object": null
}
```

### HTTP Request
`GET /api/v1/Book`


<!-- END_2ab33489e7fcc03c8e921d05f0b3db39 -->

<!-- START_510b68e099e1b4f54b32646af66c9a46 -->
## /api/v1/Book/Show/{ID}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/Book/Show/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/Book/Show/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "code": 200,
    "message": "شما دسترسی به این بخش را ندارید",
    "object": null
}
```

### HTTP Request
`GET /api/v1/Book/Show/{ID}`


<!-- END_510b68e099e1b4f54b32646af66c9a46 -->

<!-- START_3dec21b5bbc2b6a061bcb97f04a97d63 -->
## /api/v1/Book/Edit/{ID}
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/Book/Edit/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/Book/Edit/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /api/v1/Book/Edit/{ID}`


<!-- END_3dec21b5bbc2b6a061bcb97f04a97d63 -->

<!-- START_f4a713d0b31b6481d92624fd3059f69e -->
## /api/v1/Book/AddBook
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/Book/AddBook" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/Book/AddBook"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /api/v1/Book/AddBook`


<!-- END_f4a713d0b31b6481d92624fd3059f69e -->


