--CHecks that the Bid_Amount is less than the Buy_Price if the Buy_Price is not null after an insert on Bids
PRAGMA foreign_keys = ON;
drop trigger if exists bidBuyAmountInsert;
create trigger bidBuyAmountInsert
after insert on Bids
when (new.Bid_Amount > (select Buy_Price from Auction as A where new.ItemID = A.ItemID) and (select Buy_Price from Auction as A where new.ItemID = A.ItemID)is not null)
begin
	select raise(rollback, "Bid_Amount must be less than or equal to the items buy price");
end;


