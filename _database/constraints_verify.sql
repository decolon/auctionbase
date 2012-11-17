select UserID from Auction where UserID not in (select UserID from User);
select ItemID from Bids where ItemID not in (select ItemID from Auction);
select ItemID from Category where ItemID not in (select ItemID from Auction);
select UserID from Bids where UserID not in (select UserID from User);

select * from User where UserID in (select UserID from Auction) and (Location is null or Country is null);
select * from Bids where Time > (select Auction_Time from AuctionBaseTime);
select * from Bids as B where Time < (select Start_Time from Auction as A where A.ItemID = B.ItemID) or Time > (select End_Time from Auction as A where A.ItemID = B.ItemID);
select * from Bids, Auction where Bids.Bid_Amount > Auction.Buy_Price and Bids.ItemID = Auction.ItemID and Buy_Price is not null;

select "Database Loaded, Contraints checked, Triggers added";

