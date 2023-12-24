24.12.2024 - repo was closed. All new updates will be in new repo https://github.com/booktorium/

# BookTorium

## PHP Engine for DJVU / PDF Online Library with OCR Futures

Full code of working online library https://t-library.net

The code is quite old and there is too much Russian in the user interface. I am planning to completely rewrite the code taking into account the new PHP standards.

The project has a complex system of limiting users to become a universal book library engine. Each step of the user on the site is evaluated in points. For example, reading books subtracts 5 points from the user, but adding a book to the system increases user points by 1000. Commenting on a book adds 1 point to the user. Etc. Everything is administered and configured from the admin area.

The bookorium has the ability to extract pages from pdf / djvu on the fly in jpg format for reading books online. It is also possible to recognize the pages of books. For these functions, the permission of the php to perform the exes function is required and the ddjvu, gs, tesseract must be installed in the system.

Default admin password is: admin/admin

There are 3 folders in the project:

**www** - the main user interface for reading books. (https://www.t-library.net).

**manager** - here you can add / edit / delete books, authors, etc. (https://lbm.t-library.net).

**admin** - here you can set user state / permissions, manage database errors, etc. (https://admin.t-library.net).

For the first run, you need to find the **config.php** file in each folder and write the appropriate MySQL db connection parameters.

It is possible to store OCR images from PDF / DJVU books on different servers, manage loads. For an explanation of this future, please contact me directly.

