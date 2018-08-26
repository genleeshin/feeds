#!/bin/bash
spath=/path/to/feeds3/feeds/src
feed_dl_path=/path/to/feeds3/feeds/storage
log_path=/path/to/feeds/old/logs
cur_date=$(date +"%m-%d-%Y")
log_file="$log_path/feed_dl_log.txt"

#rm $feed_dl_path/*

echo "-------------------------------" >> $log_file
echo "*******STARTING AMAZON DOWNLOAD*******" >> $log_file

# /usr/bin/php $spath/azfeed.php camera_retail
# /usr/bin/php $spath/azfeed.php camera_mp
#/usr/bin/php $spath/azfeed.php ce_retail
# /usr/bin/php $spath/azfeed.php ce_mp
# /usr/bin/php $spath/azfeed.php videogames_retail
# # /usr/bin/php $spath/azfeed.php videogames_mp
# # /usr/bin/php $spath/azfeed.php hpc_retail
# # /usr/bin/php $spath/azfeed.php hpc_mp
# # /usr/bin/php $spath/azfeed.php toys_retail
# # /usr/bin/php $spath/azfeed.php toys_mp
# # /usr/bin/php $spath/azfeed.php kitchen_retail
# # /usr/bin/php $spath/azfeed.php kitchen_mp
# # /usr/bin/php $spath/azfeed.php large_appliances_retail
# # /usr/bin/php $spath/azfeed.php large_appliances_mp
# #/usr/bin/php $spath/azfeed.php pc_notebook_retail
# #/usr/bin/php $spath/azfeed.php pc_notebook_mp

#/usr/bin/php $spath/drop_full_text.php

/usr/bin/php $spath/feed.php camera retail
/usr/bin/php $spath/feed.php camera ce
# /usr/bin/php $spath/amazon.php ce retail
# /usr/bin/php $spath/amazon.php ce mp
# /usr/bin/php $spath/amazon.php videogames retail
# # /usr/bin/php $spath/amazon.php videogames mp
# # /usr/bin/php $spath/amazon.php hpc retail
# # /usr/bin/php $spath/amazon.php hpc mp
# # /usr/bin/php $spath/amazon.php toys retail
# # /usr/bin/php $spath/amazon.php toys mp
# # /usr/bin/php $spath/amazon.php kitchen retail
# # /usr/bin/php $spath/amazon.php kitchen mp
# # /usr/bin/php $spath/amazon.php large_appliances retail
# # /usr/bin/php $spath/amazon.php large_appliances mp
#/usr/bin/php $spath/amazon.php pc_notebook retail
#/usr/bin/php $spath/amazon.php pc_notebook mp

#/usr/bin/php $spath/end_process.php
