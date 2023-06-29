
# Auth

**POST** ***/api/login*** - will returned a token

## Params
- ***login*** - user login
- ***password*** - user password

# Users

## Create
**POST** ***/api/users/*** - register new user

Only admin can.
### Params
- ***login*** - user login (unique)
- ***name*** - user public name
- ***password*** - user password

## Read
**GET** ***/api/users/*** - all users **(need auth)**

**GET** ***/api/users/{id}*** - single user **(need auth)**

**GET** ***/api/users/{id}/posts*** - show all users's posts **(need auth)**

## Update
**PUT/PATCH** ***/api/users/{id}*** - update the user **(need auth)**

Only admin and the self can.
### Params
- ***name*** (no required)

## Delete
**DELETE** ***/api/users/{id}*** - delete the user **(need auth)**

Only admin can.

___

# Posts

## Create
**POST** ***/api/posts/*** - create new post **(need auth)**
### Params
- ***title*** - title of the post (min:8)
- ***content*** - content of the post
- ***is_published (bool)*** - if the post are ready to publish. **(no required. default = true)** 

## Read
**GET** ***/api/posts/*** - show all posts

**GET** ***/api/posts/{id}/*** - single post

if the post is no published will returned **404** code. The post wiil available only for **admin** and his **author**

## Update
**PUT/PUTCH** ***/api/posts/{id}/*** - update the post **(need auth)**

Only admin and the post's author can.
### Params
- ***title*** - post's title (no required)
- ***content*** - post's content (no required)
- ***is_published*** - the post is public or not (no required)

## Delete
**DELETE** ***/api/posts/{id}/*** - delete the post **(need auth)**

Only admin and the post's author can.