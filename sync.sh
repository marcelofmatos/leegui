set -x
rsync -e 'ssh -p 2210' -av --perms ./ --exclude=storage/ --exclude=.env panel@panel.cloud.ligerosmart.com:/var/www/html/
# erro no rsync
# protocol version mismatch -- is your shell clean?
# sincronizando no filezilla
