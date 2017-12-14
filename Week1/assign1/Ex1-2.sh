echo 'cd /var/log ; for x in `ls *.log`; do echo "$x,  `du -s $x | cut -f -1`" >> ~/Desktop/log_dump.csv ; done' > ~/Desktop/Ex.sh ;
sudo mv ~/Desktop/Ex.sh /usr/local/bin/mostafa ;
sudo chown root: /usr/local/bin/mostafa ;
sudo chmod 755 /usr/local/bin/mostafa

echo "vmstat -s | awk  ' $0 ~ /total memory/ {total=$1 } $0 ~/used memory/ {used=$1} END{if((used/total)*100 >= 80){ print \"Virtual Memory is at \" (used/total)*100 "%"} else { print \"Everything is OK\" }}' ;

df | awk '$0 ~ /dev\/sda1/ {total2=$2; used2=$3} END{if((used2/total2)*100 >= 80){ print \"Hard Disk is at \" (used2/total2)*100 "%"} else{print \"Everything is OK\"}}'" > ~/Desktop/Ex2.sh ;

sudo mv ~/Desktop/Ex2.sh /usr/local/bin/kabalan ;
sudo chown root: /usr/local/bin/kabalan ;
sudo chmod 755 /usr/local/bin/kabalan

# Execute Ex1.sh from the directory contains it then type the command "mostafa" from any directory (ex1 solution) and "kabalan" from any directory (ex2 solution)

