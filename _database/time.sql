drop table if exists AuctionBaseTime;
create table AuctionBaseTime(Auction_Time TEXT);
insert into AuctionBaseTime values("2001-12-20 00:00:01");
select Auction_Time from AuctionBaseTime;
