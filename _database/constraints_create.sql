create table AuctionBaseTime(Auction_Time TEXT, TimerStart TEXT);
insert into AuctionBaseTime values("2001-12-20 12:00:01", null);
create table UserLogin(UserID varchar primary key REFERENCES User(UserID), Password varchar, Admin integer);
create table Bids (UserID varchar REFERENCES User(UserID), Time varchar NOT NULL, ItemID integer REFERENCES jAuction(ItemID), Bid_Amount real NOT NULL, PRIMARY KEY(UserID, Time), UNIQUE(ItemID, Time));
create table Category (ItemID integer REFERENCES Auction(ItemID), Category varchar NOT NULL); 
create table Auction (ItemID integer primary key, Name varchar NOT NULL, Current_Price real NOT NULL CHECK(Current_Price <= Buy_Price or Buy_Price is null), Buy_Price real, First_Bid real NOT NULL CHECK(First_Bid <= Current_Price), Start_Time varchar NOT NULL, End_Time varchar NOT NULL, Description varchar NOT NULL, UserID varchar REFERENCES User(UserID), CHECK(First_Bid > 0), CHECK(Start_Time < End_Time), CHECK(First_Bid <= Buy_Price or Buy_Price is NULL));
create table User (UserID varchar primary key, Rating integer NOT NULL, Location varchar, Country varchar);
insert into User values("decolon", 0, "philly", "usa");
insert into UserLogin values("decolon", "decolon", 1);





