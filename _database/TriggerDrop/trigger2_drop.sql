--Deletes trigger that makes sure Auction Time has 1 tupple 
PRAGMA foreign_keys = ON;
--makes sure that now tupples can be added, only can update tupples
--meaning it will not accept anything. so cant come up with a modification that would activate the trigger and pass through
--so will just drop the trigger
drop trigger updateAuctionTimeCount;
