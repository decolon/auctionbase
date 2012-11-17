--Drops the trigger that cHecks that the Bid_Amount is less than the Buy_Price if the Buy_Price is not null after an insert on Bids
PRAGMA foreign_keys = ON;
insert into Bids values ("ienstine", "2001-12-07 09:00:04","1044027229", 50);
delete from Bids where UserID = "ienstine" and Time = "now";
drop trigger bidBuyAmountInsert;

