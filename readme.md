![image](https://user-images.githubusercontent.com/5869754/187099238-39221fd5-988f-4f9b-ad09-67c42a749c7a.png)
# Citizens Registration
This project allows register citizens and the search for citizens by their NIS number.
By entering the citizen's name, the NIS number is automatically generated.

## Features
* Register citizens
* Generate NIS number automatically
* Find citizens by NIS number

> Status: Developing ⚠️

> IMPORTANT: This application does not use any PHP framework INTENTIONALLY ⚠️

## Tecnologies Used
<table>
    <tr>
        <td>PHP</td>
        <td>Composer</td>
        <td>SQLITE</td>
        <td>Vue.js</td>
        <td>Bootstrap</td>
    </tr>
    <tr>
        <td>7.4.30</td>
        <td>2.3.10</td>
        <td>3</td>
        <td>2.7.8</td>
        <td>5.0.2</td>
    </tr>
</table>

## How to run the application
1. Install PHP composer if you don't have it (https://getcomposer.org/)
2. Copy .env.example to a new file and rename to .env
3. Uncomment pdo_sqlite extension in php.ini (change ';extension=pdo_sqlite' to extension=pdo_sqlite)
4. Run 'make' command on terminal

## How to run the tests
Run 'make test'


## License
GNU General Public License v3.0 (https://www.gnu.org/licenses/gpl-3.0.html)