## dumping
mongodump --db promostock --out ./backups/`date +"%Y%m%d"`

## restore
mongorestore --db promostock --drop ./backups/20191203/promostock