# Camaguru

MVC web app (a.k Instagram) allowing you to make basic photo editing using your webcam and some predefined images.

Full specification: https://cdn.intra.42.fr/pdf/pdf/778/camagru.en.pdf

- [Server] PHP (pure)

- [Client] HTML - CSS - JavaScript (only with browser natives API)

- [Webserver] Apache2

- [Deployment] Docker


#### Goals:

- Everything must be secured (CSRF, SQl-debugging)
- Sign In and Sign Up components with email confirmation
- Using webcam, capture a picture and mix it with the list of superposable images
- Gallery of photos of all users with ability to comment and like photos
- The author of the image should be notified by email after new comment
- Profile to change user private data
- “AJAXify” exchanges with the server.

## Getting Started

### Install docker

```
brew install docker docker-machine docker-compose
docker-machine create --driver virtualbox Camaguru
eval $(docker-machine env Camaguru)
```

### Configure sSTMP

In Dockerfile change fields with your email and password to proper work of send mail service:
```
AuthUser=[your gmail]
AuthPass=[password of email]
```

## Build and Run

```
docker-compose up --build -d
go to http://localhost:8001
```

### Notes

Run mysql client:

```
docker-compose exec db mysql -u root -p
```

Enter in docker container:
```
docker exec -it {container name} bash
 ```
 
Remove all:
  ```
 docker stop $(docker ps -a -q)
 docker rm $(docker ps -a -q)
 docker rmi $(docker images -a -q)
  ```
  
 #### P.S
 This project is about functionality not about beautiful design :)