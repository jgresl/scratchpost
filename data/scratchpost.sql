DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS Scratches;
DROP TABLE IF EXISTS Post;
DROP TABLE IF EXISTS User;

CREATE TABLE User (
	user_ID INT AUTO_INCREMENT,
	userName VARCHAR(20) NOT NULL UNIQUE,
	userEmail VARCHAR(30) NOT NULL UNIQUE,
	userPassword VARCHAR(20) NOT NULL,
	userStatus VARCHAR(20) NOT NULL DEFAULT 'Enabled',
	userType VARCHAR(20) NOT NULL DEFAULT 'Basic',
	userFirstName VARCHAR(20) NOT NULL,
	userLastName VARCHAR(20) NOT NULL,
	userBirthdate DATE NOT NULL,
	userFirstLogin TIMESTAMP NOT NULL DEFAULT NOW(),
	userLastLogin TIMESTAMP NOT NULL DEFAULT NOW(),
	userImage BLOB,
	PRIMARY KEY (user_ID)
);

CREATE TABLE Post (
	post_ID INT AUTO_INCREMENT,
	postDate TIMESTAMP DEFAULT NOW(),
	postTitle VARCHAR(100) NOT NULL,
	postText VARCHAR(1000),
	postStatus VARCHAR(20) DEFAULT 'Enabled',
	postImage BLOB,
	user_ID INT NOT NULL,
	PRIMARY KEY (post_ID),
	FOREIGN KEY (user_ID) REFERENCES User(User_ID) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE Comments (
	user_ID INT,
	post_ID INT,
	commentText VARCHAR(1000),
	commentDate TIMESTAMP DEFAULT NOW(),
	commentStatus VARCHAR(20) DEFAULT 'Enabled',
	PRIMARY KEY (user_ID, post_ID, commentDate),
	FOREIGN KEY (user_ID) REFERENCES User(user_ID) ON DELETE NO ACTION ON UPDATE CASCADE,
	FOREIGN KEY (post_ID) REFERENCES Post(post_ID) ON DELETE NO ACTION ON UPDATE CASCADE		
);

CREATE TABLE Scratches (
	user_ID INT,
	post_ID INT,
	scratchDate TIMESTAMP DEFAULT NOW(),
	PRIMARY KEY (user_ID, post_ID),
	FOREIGN KEY (user_ID) REFERENCES User(user_ID) ON DELETE NO ACTION ON UPDATE CASCADE,
	FOREIGN KEY (post_ID) REFERENCES Post(post_ID) ON DELETE NO ACTION ON UPDATE CASCADE
);

INSERT INTO User (userName, userEmail, userPassword, userType, userFirstName, userLastName, userBirthdate) VALUES ('jgresl', 'jgresl@hotmail.com', 'jgresl', 'Admin', 'Jonathan', 'Gresl', '1985-7-26');
INSERT INTO User (userName, userEmail, userPassword, userType, userFirstName, userLastName, userBirthdate) VALUES ('jaxong', 'jgresl2@hotmail.com', 'jaxong', 'Basic', 'Jaxon', 'Gresl', '2020-02-22');