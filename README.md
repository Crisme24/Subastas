# Subastas with Symfony 4

### Prerequisites
You must have COMPOSER installed once you cloned this project

### Installation
```sh
composer install
```

This will create a vender folder which contains third party dependencies.

## VIEWS

### Home
/
Show all the active auctions at the moment.
### USERS
/register

It allows visitors to register new accounts into the system.

/login
To authenticate the user.
<img src="http://g.recordit.co/M1GlMVoHex.gif" alt="loginAnimation"/>
### PUJAS
/ver-pujas
It shows all the bids placed by the user. If the user's role is admin he would be able to see all the bids placed.

/ver-subasta
Lists all the auctions and allows the admins to perform diferent CRUD operations.


/editar-puja/{id}

Allows the admins to edit the selected bid.

/borrar-puja/{id}
Allows the admins to remove the selected bid.

/crear-puja
Allows the admins to create a new bid.

### SUBASTAS
/ver-subasta/{id}
Shows the selected auction detailed.

<img src="http://g.recordit.co/n8BSa6Gvdy.gif" alt="Show Subasta Animation"/>

/editar-subasta/{id}
Allows the admins to edit the selected auction.
<img src="http://g.recordit.co/kIWn9VTUUe.gif" alt="Edit Subasta Animation"/>

/borrar-subasta/{id}
Allows the admins to remove the selected auction.
<img src="http://g.recordit.co/50od0KacIb.gif" alt="Remove Subasta Animation"/>

/crear-subasta
Allows the admins to create a new auction.
<img src="http://g.recordit.co/M75Eskmmml.gif" alt="Create Subasta Animation"/>