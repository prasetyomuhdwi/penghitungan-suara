<!-- Table of Contents -->
# :notebook_with_decorative_cover: Table of Contents

- [About the Project](#star2-about-the-project)
  * [Tech Stack](#space_invader-tech-stack)
  * [Environment Variables](#key-environment-variables)
- [Getting Started](#toolbox-getting-started)
  * [Prerequisites](#bangbang-prerequisites)
  * [Installation](#gear-installation)
- [Contributing](#wave-contributing)
  

<!-- About the Project -->
## :star2: About the Project

<div align="center"> 
  <img src="https://raw.githubusercontent.com/prasetyomuhdwi/penghitungan-suara/dev/assets/images/screenshot.png" alt="screenshot" />
</div>

This project is a 2020 regional election vote counting project

<!-- TechStack -->
### :space_invader: Tech Stack
  <ul>
    <li><a href="https://codeigniter.com/">CodeIgniter</a></li>
    <li><a href="https://www.php.net/">PHP 5.6</a></li>
    <li><a href="https://getcomposer.org/">Composer 2.2</a></li>
    <li><a href="https://httpd.apache.org/">Apache</a></li>
    <li><a href="https://www.mysql.com/">MySQL</a></li>
  </ul>

  or for local development you can use [XAMPP Windows 5.6.30](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/5.6.30/)  or the equivalent of the tech stack. 

<!-- Env Variables -->
### :key: Environment Variables

To run this project, you will need to add the following environment variables to your .env file

```
database.default.hostname 
database.default.database
database.default.username
database.default.password
database.default.dbdriver
```

<!-- Getting Started -->
## 	:toolbox: Getting Started

<!-- Prerequisites -->
### :bangbang: Prerequisites

This project uses Composer as package manager

<!-- Installation -->
### :gear: Installation

1. Clone this project.
1. Go to the project folder 
	```bash
   	cd penghitungan-suara
	```
	> if you are using *XAMPP* put this project folder inside htdocs 
1. Install composer dependencies 

	```bash
   	composer install
	```
1. Create .env
	> Duplicate the *.env.example* file, rename it to *.env*
1. Your done :sparkles:
	> if you are using *XAMPP* put don't forget to start both apache and mysql

<!-- Contributing -->
## :wave: Contributing

<a href="https://github.com/burhanyuswantyo/penghitungan-suara/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=burhanyuswantyo/penghitungan-suara&max=400&colomns=20" />
</a>


Contributions are always welcome!

See `contributing.md` for ways to get started.
