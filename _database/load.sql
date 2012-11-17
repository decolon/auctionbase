.separator <>
.import User.dat User
.import Auction.dat Auction
.import Bids.dat Bids
.import Category.dat Category
update Auction set Buy_Price = null where Buy_Price = 'null';
update User set Country = null where Country = 'null';
update User set Location = null where Location = 'null';
