--Deletes the trigger that checks that the Bid_Amount is less than the Buy_Price if the Buy_Price is not null after an update on Bids
PRAGMA foreign_keys = ON;
update Bids set Bid_Amount = 50 where UserID = "ienstine" and ItemID = "1044027229";
update Bids set Bid_Amount = 51.72 where UserID = "ienstine" and ItemID = "1044027229";
drop trigger bidBuyAmountUpdate;


