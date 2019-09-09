<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# ZSSN (Zombie Survival Social Network)

## Instalation **Docker** (Windows)

### Commnd build:

```console
docker build --file .\worker.dockerfile --tag zssn:1 .
```
### Commnd Run:

```console
docker run -it -v ${pwd}:/home/master/data -p 80:8000 zssn:1 /home/master/data/artisan serve --host=0.0.0.0
```

### Survivor </br>

> ### Create Survivor

>  | method | url |
>  | ---------- | ----------- |
>  |**GET**|_/api/survivors/_|

>   **Body**:

```json
{
  "name": "Gilvan Leal",
  "birth": "1990-10-19",
  "gender": "male",
  "latitude": "10.123456",
  "longitude": "20.654321",
  "recourses": [{
  	"item_id": "1",
  	"amount": "3"
  	}
  ]
}
```

> ### List Survivors

> | method | url |
> | ---------- | ----------- |
> |**GET**|_/api/survivors/_|

>  **Response**:

```json
{
    "data": [
        {
            "id": 1,
            "name": "Gilvan Leal",
            "age": 28,
            "gender": "male",
            "is_infected": false,
            "location": {
                "latitude": "10.123456",
                "longitude": "20.654321"
            },
            "inventory": [
                {
                    "item_id": 1,
                    "item_name": "Water",
                    "item_point": "4",
                    "amount": "3",
                    "links": {
                        "self": "http://localhost/api/recourses/1",
                        "item_url": "http://localhost/api/items/1"
                    }
                }
            ],
            "links": {
                "self": "http://localhost/api/survivors/1"
            }
        }
 ]}
 ```

### Update Suvivor location

> | method | url |
> | ---------- | ----------- |
> |**GET**|_/api/survivors/{suvivor_id}/update-location/_|

### Report infected survivor

> | method | url |
> | ---------- | ----------- |
> |**GET**|_/api/survivors/{suvivor_id_report}/report-contamination/{suvivor_id_reported}_|

>  **Response**:

### Trade survivor

> | method | url |
> | ---------- | ----------- |
> |**PUT**|_/api/trades/{survivor1_id}/swap/{survivor2_id}_|

>   **Body**:

```json
{
	"recourses": {
  		"{survivor1_id}"  :  [{"item_id": "4", "amount": "4" }],
  		"{survivor2_id}" : [{"item_id": "1", "amount": "1"}]
	}
}
```
>  **Response**:

### Report </br>

### Infecteds survivor

> | method | url |
> | ---------- | ----------- |
> |**GET**|_/api/report/infecteds/_|

### Non-infecteds survivor

> | method | url |
> | ---------- | ----------- |
> |**GET**|_/api/report/non-infecteds/_|

### Avg recourses  per survivor

> | method | url |
> | ---------- | ----------- |
> |**GET**|_/api/report/avg-recourses/_|

### Lost point per survivor infected

> | method | url |
> | ---------- | ----------- |
> |**GET**|_/api/report/lost-point/_|
