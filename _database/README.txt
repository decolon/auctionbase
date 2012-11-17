Category
ItemID <> Category

No keys, no dependancies

Auction
ItemID<>Name<>Current_Print<>Buy_Price<>First_Bid<>Start_Time<>End_Time<>Description<>UserID

ItemID is a key.  Every ItemID has a single Name, UserID(sell), Current Price, Buy Price, First Bid, Start Time, End Time, and Description associated with it.  This means if you know the ItemID you know every other value. 

User
UserID<>Rating<>Location<>Country

UserID is a key.  A user has a single rating, location, and country, if all values are present.  This means once you know the user, you know all other values.

Bids
UserID<>Time<>ItemID<>Bid_Amount

UserID/Time is a key.  A user can only bid once at a specific time, so every UserID/Time of Bid pare maps to a specific ItemID and Bid Amount



Everything is in BCNF.  All functional dependancies have a key on their left hand side.  
Everything is in 4NF.  There are no multi variable dependancies. 




