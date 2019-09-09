<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

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

**Response** List of Survivors

**Code**: `200`
