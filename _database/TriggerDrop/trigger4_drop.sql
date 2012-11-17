--Drops the trigger that checks to make sure when you update Auction the user has a non null location and country in User table
PRAGMA foreign_keys = ON;
insert into User values ("testUser", 1, "location", "country"); 
update Auction set UserID = "testUser" where ItemID = "1043374545";
update Auction set UserID = "rulabula" where ItemID = "1043374545";
delete from User where UserID = "testUser";
drop trigger updateSellerLocation;

