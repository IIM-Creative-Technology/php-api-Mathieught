## Install

Créer un fichier `.env` à l'aide du fichier `.env.example`.<br/>

Commande a exécuter au lancement :

```
php artisan migrate
php artisan db:seed
php artisan jwt:secret
```

lancer le serveur :

```
php artisan serve
```

## Connection administrateur

```
POST http://127.0.0.1:8000/api/auth/login

```

Identifiant de connection :

|       email       | password |
| :---------------: | :------: |
| karine@gmail.com  | password |
| nicolas@gmail.com | password |
| alexis@gmail.com  | password |

## Routes

Route a utiliser avec le `Bearer Token` obtenu lors de la connexion.

### Liste des routes

#### Promotion

-   `name` : String
-   `year_end` : Integer

```
GET /api/classrooms
GET /api/classrooms/{id}
POST /api/classrooms
PUT /api/classrooms/{id}
DELETE /api/classrooms/{id}
```

#### Professeur
-   `firstname` : String
-   `lastname` : String
-   `year_start` : Integer

```
GET /api/professors
GET /api/professors/{id}
POST /api/professors
PUT /api/professors/{id}
DELETE /api/professors/{id}
```

#### Etudiant

-   `lastname` : String
-   `fristname` : String
-   `age` : Integer
-   `year_start` : Integer
-   `classroom_id` : Integer

```
GET /api/students
GET /api/students/{id}
POST /api/students
PUT /api/students/{id}
DELETE /api/students/{id}
```


#### Courses 

-   `name` : String
-   `date_start` : Date (Y-m-d)
-   `date_end` : Date (Y-m-d)
-   `professor_id` : Integer
-   `classroom_id` : Integer

```
GET /api/courses
GET /api/courses/{id}
POST /api/courses
PUT /api/courses/{id}
DELETE /api/courses/{id}
```

#### Notes 

-   `mark` : Integer
-   `student_id` : Integer
-   `course_id` : Integer

```
GET /api/marks
GET /api/marks/{id}
POST /api/marks
PUT /api/marks/{id}
DELETE /api/marks/{id}
```
