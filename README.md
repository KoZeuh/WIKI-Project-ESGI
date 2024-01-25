# Representation of a "WIKI" #

<p align="center">
   <strong>It's a simple web application that lets you write articles with versions and comments.</strong>
   <strong>A user, article and version management panel is also available.</strong>
</p>

<details>
  <summary><strong>➡️ Screenshots</strong></summary>
  <br/>
  <img align="left" src="https://github.com/KoZeuh/WIKI-Project-ESGI/blob/main/img/img1.png" width="280" target="_blank"/>
  <img src="https://github.com/KoZeuh/WIKI-Project-ESGI/blob/main/img/img2.png" width="280" target="_blank"/>
  <br/>
  <img align="left" src="https://github.com/KoZeuh/WIKI-Project-ESGI/blob/main/img/img3.png" width="280" target="_blank"/>
  <img src="https://github.com/KoZeuh/WIKI-Project-ESGI/blob/main/img/img4.png" width="280" target="_blank"/>
</details>

### Features 🚀

- 🌐 **Authentication & role management**

- 🔄 **Content categorization**

- 📊 **Search engine by category and/or keywords**

- ✏️ **WYSIWYG for content creation, modification and formatting**

- 📶 **Article version history**

- 🧩 **Display of 2 randomly chosen articles of the day**

- 🖱️ **API REST to access content programmatically**

- ⚙️ **Management panel for CMS administrators**
  
## Prerequisites for use 🛠️
- NONE

## Prerequisites for installation 🛠️

- PHP 8.0.X
- MariaDB 10.10.X

## How to Run the Project ▶️

1. Clone this repository to your local machine.
2. Import SQL file.
3. Modify your database connection information. (`App/Database/Database.php`)
(__!! The storage of this kind of data is advised to be in an environment file !!! We didn't have time to set it up...__)

## Administrator Role 🔑

1. Create a user account.
2. Replace "ROLE_USER" with your user's "ROLE_ADMIN" in the "users" table and in the "role" field.
3. Reconnect to site to obtain role permissions.


## How to use the API 🔍

1. Install the extension [Talend](https://chromewebstore.google.com/detail/talend-api-tester-freeed/aejoelaoggembcahagimdiliamlcdmfm)
2. Import JSON file [click here](https://github.com/KoZeuh/WIKI-Project-ESGI/blob/main/APIFile.json)
3. Add the API key to Talend's environment variables (top left, same as Postman).
4. The API key is visible in the user profile.

## Authors ✨

[@KoZeuh](https://github.com/KoZeuh)
- Site design.
- Article list and display of a selected article.
- Display of 2 articles of the day and articles of the month.
- List of article versions and display of a selected version.
- User authentication.
- Content categorization / Search by category.

[@Nikoolaii](https://github.com/Nikoolaii)
- Display 1 article of the day. (Changed to 2 articles currently by KoZeuh)
- Full "WYSIWYG" implementation.
- Implement article creation for users.
- Complete production of the management panel.
- Creation of the UML diagram.
  
[@antoinebtn](https://github.com/antoinebtn)
- Router implementation.
- Password change.
- Search by key words.
- Complete realization of the REST API.
- Creation of the MCD.
  
## License 📄

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
