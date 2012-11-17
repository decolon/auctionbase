--Deletes the trigger that checks to make sure when you insert into Auction the user has a non null location and country in User table
PRAGMA foreign_keys = ON;
insert into User values ("testUser", 1, "location", "country"); 
insert into Auction values ("-1", "Test", 1.00, null, .01, "now", "z", "test", "testUser");
delete from Auction where ItemID = "-1";
delete from User where UserID = "testUser";
drop trigger insertSellerLocation;




