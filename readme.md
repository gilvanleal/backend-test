<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

### Docker (Windows)

#### Commnd build:

```console
docker build --file .\worker.dockerfile --tag zssn:1 .
```

#### Commnd Run:

```console
docker run -it -v ${pwd}:/home/master/data -p 80:8000 zssn:1 /home/master/data/artisan serve --host=0.0.0.0
```

### Create Survivor
**Method**: **`PUT`**

**URL**: `/api/survivors/`

**Body**:
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
### List Survivos
**Method**: **`GET`**

**URL**: `/api/survivors/`

**Code**: `200`

**Response**:
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


