<img src="https://github.com/user-attachments/assets/749e2795-6273-418e-9009-100cb5d72c33" alt="MockGPT logo">

# 🧪 mockGPT
A mock data generator fully integrated with chat-gpt, unsplash and docker.

## 🛸 Installation
### 📜 Prerequisites
- Any enviroment to run php

1. Clone the repository
```
git clone https://github.com/giovanni-iannaccone/mockGPT
```

### ⚙ On xampp
2. Move the mockGPT folder inside /xampp/htdocs
3. Start apache

### 🐳 On Docker
2. Enter the directory
```sh
cd mockGPT
```
3. Build and run using the compose
```sh
docker-compose up -d
```

## 🛠 Write configurations
Create a .json file with this structure

```json
"return_types": {
  
}
"number_of_data_to_generate": <the int number of mock data>
```

## 👨‍💻 Using
Go to http://localhost:[PORT]/index.php?configurations=[CONFIGURATION_FILE].json   <br/><br/>
- [PORT]: this must be the port the php server is running on <br/>
- [CONFIGURATION_FILE]: this must be the path to the configuration file for mockGPT <br/><br/>

Send an http request ( using axios, fetch or any method you like ) to the url and retrieve the data in json format. 

## 🧩 Contributing
We welcome contributions! Please follow these steps:

1. Fork the repository.
2. Create a new branch ( using <a href="https://medium.com/@abhay.pixolo/naming-conventions-for-git-branches-a-cheatsheet-8549feca2534">this</a> convention).
3. Make your changes and commit them with descriptive messages.
4. Push your changes to your fork.
5. Create a pull request to the main repository.

## ⚖ License
This project is licensed under the GPL-3.0 License. See the LICENSE file for details.

## ⚔ Contact
For any inquiries or support, please contact iannacconegiovanni444@gmail.com <br/>
Visit my site for more informations about me and my work https://giovanni-iannaccone.github.io
