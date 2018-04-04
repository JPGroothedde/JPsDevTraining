sDev-Base is used as the starting point for all sDev projects.

To setup sDev-Base, ensure the following:

- You have the latest copy of sDev-Base checked out from GitHub
- You have MAMP server running with apache and MySQL
- Your server & database is correctly configured in /includes/configuration/configuration.inc
- If you are running Windows, ensure that you have set up your MySQL database with lower_case_table_names = 2

Worth a mention:
- sDev currently only fully supports MySQL. Other databases may cause unforseen errors

The following are useful commands on macOS for linking mysql from MAMP to the OS
- sudo ln -s /Applications/MAMP/Library/bin/mysql /usr/local/bin/mysql
- sudo ln -s /Applications/MAMP/Library/bin/mysqlcheck /usr/local/bin/mysqlcheck 
- sudo ln -s /Applications/MAMP/Library/bin/mysqldump /usr/local/bin/mysqldump

To configure your IDE to work with git on Windows, you might need to configure the git exe path:

The location for git.exe will vary depending on what Git-software you have installed! The git.exe file is located inside your Git-software installation directory, usually inside a folder called bin.

Some examples of standard locations:
- Software	Standard location: Git	C:\Program Files (x86)\Git\bin
- SmartGit	C:\Program Files (x86)\SmartGit\git\bin\git.exe
- GitHub For Windows	C:\Users\'username'\AppData\Local\GitHub\PortableGit_'numbersandletters'\cmd\git.exe

