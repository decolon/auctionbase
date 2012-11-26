sqlite3 auctionbase_data < drop.sql;
sqlite3 auctionbase_data < constraints_create.sql;
sh loadTriggers.sh
sqlite3 auctionbase_data < constraints_verify.sql;


