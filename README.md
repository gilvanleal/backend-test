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

> **Body**
```json
{
	"latitude": 99.999,
	"longitude": 99.999
}
```

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


# Backend Developer Coding Test

Be sure to read **all** of this document carefully, and follow the guidelines within.

## Problem Description

ZSSN (Zombie Survival Social Network). The world as we know it has fallen into an apocalyptic scenario. A laboratory-made virus is transforming human beings and animals into zombies, hungry for fresh flesh.

You, as a zombie resistance member (and the last survivor who knows how to code), was designated to develop a system to share resources between non-infected humans.

## Requirements

You will develop a ***REST API*** (yes, we care about architecture design even in the midst of a zombie apocalypse!), which will store information about the survivors, as well as the resources they own.

In order to accomplish this, the API must fulfill the following use cases:

- **Add survivors to the database**

  A survivor must have a *name*, *age*, *gender* and *last location (latitude, longitude)*.

  A survivor also has an inventory of resources of their own property (which you need to declare when upon the registration of the survivor).

- **Update survivor location**

  A survivor must have the ability to update their last location, storing the new latitude/longitude pair in the base (no need to track locations, just replacing the previous one is enough).

- **Flag survivor as infected**

  In a chaotic situation like that, it's inevitable that a survivor may get contaminated by the virus.  When this happens, we need to flag the survivor as infected.

  An infected survivor cannot trade with others, can't access/manipulate their inventory, nor be listed in the reports (infected people are kinda dead anyway, see the item on reports below).

  **A survivor is marked as infected when at least three other survivors report their contamination.**

  When a survivor is infected, their inventory items become inaccessible (they cannot trade with others).

- **Survivors cannot Add/Remove items from inventory**

  Their belongings must be declared when they are first registered in the system. After that they can only change their inventory by means of trading with other survivors.

  The items allowed in the inventory are described above in the first feature.

- **Trade items**:

  Survivors can trade items among themselves.

  To do that, they must respect the price table below, where the value of an item is described in terms of points.

  Both sides of the trade should offer the same amount of points. For example, 1 Water and 1 Medication (1 x 4 + 1 x 2) is worth 6 ammunition (6 x 1) or 2 Food items (2 x 3).

  The trades themselves need not to be stored, but the items must be transferred from one survivor to the other.

| Item         | Points   |
|--------------|----------|
| 1 Water      | 4 points |
| 1 Food       | 3 points |
| 1 Medication | 2 points |
| 1 Ammunition | 1 point  |

- **Reports**

  The API must offer the following reports:

    1. Percentage of infected survivors.
    1. Percentage of non-infected survivors.
    3. Average amount of each kind of resource by survivor (e.g. 5 waters per survivor)
    4. Points lost because of infected survivor.

---------------------------------------

## Notes

1. Please use one of the following languages/frameworks: *PHP (Laravel)*, *Javascript (Node + Express)* or *Java (Spring, Seam)* - listed in descending order of desirability. It's also possible to implement a solution using *Ruby (Rails)* or *Elixir (Phoenix)*, but if you want to do so, please notify us in advance.
2. No authentication is needed (it's a zombie apocalypse, no one will try to hack a system while running from a horde of zombies);
3. We still care about proper programming and architecture techniques, you must showcase that you're worthy of surving the zombie apocalypse through the sheer strength of your skills;
4. Don't forget to make at least a minimal documentation of the API endpoints and how to use them;
5. You must write at least some automated tests;
6. From the problem description above you can either do a very bare bones solution or add optional features that are not described. Use your time wisely; the absolute optimal solution might take too long to be effective in the apocalypse, so you must come up with the best possible solution that will hold up within the least ammount of time and still be able to showcase your skills in order to prove your worth.
7. Write concise and clear commit messages, splitting your changes in little pieces.

## Q&A

> Where should I send back the result when I'm done?

Fork this repo and send us a pull request when you think you are done. We will note you about deadline directly.

> What if I have a question?

Just create a new issue in this repo and we will respond and get back to you quickly.

**Original test written by [Akita](https://t.co/W47ODZTOAc)**
