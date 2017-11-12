# WebBasedAntivirus
WebBased AntiVirus that identifies "safe" or "unsafe" files... Hopefully :D

Build a website that:

Allows the user to submit a putative infected file and shows if it is infected or not
Allows the user to submit a surely infected file, plus the name of the malware
 
Build a web application that:

Reads the file in input per bytes and, if is a surely infected one, store the sequence of bytes, say, the first 20 bytes (signature) of the file, in a database
Reads the file in input per bytes and, if it is a putative infected file, searches within the file for one of the strings stored in the database
 

Build a MySQL database that:

Stores the information regarding the infected files in input, such as name of the malware (not the name of the file), the sequence of bytes, etc...

Although ambigouous, the goal is to obtain a basic understanding on how malware detection works and how to identify, safely store and sanitize inputs. Ofcourse, this is still a work in progress and that there is no way to obtain the perfect all around antivirus, but we can come close.
