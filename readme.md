<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

#### Create Survivor
```sh
/api/survivors/?name=Gilvan Leal&gender=male&birth=1990-10-19-01-01&latitude=10.435454&longitude=11.564555&recourses[0][item_id]=1&recourses[0][amount]=4&recourses[1][item_id]=2&recourses[1][amount]=3
```
| Paramns | Type |description | Exmplo |
| ------ | ------ | -----------|-------|
|name |text|Survivor name | "Gilvan Leal"
|gender|enum|male or female| "male"
|birth|date|Birth date| 1990-10-19
|latitude|decuimal|Location|10.435454
|longitude|decimal|Location|11.564555
|recourses|array|Inventory |resources[[item_id: 1, [amout: 4]], [item_id: 2, [amout: 3]]]
