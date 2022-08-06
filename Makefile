UBUNTU_INVENTORY_FILE=ansible/inventory.ini
UBUNTU_ROLES=ansible/roles/main.yml
UBUNTU_USER=root
UBUNTU_HOST=la-service
ping:
	ansible $(UBUNTU_HOST) -i $(UBUNTU_INVENTORY_FILE) -u $(UBUNTU_USER) -m ping
la-service-all:
	ansible-playbook -i $(UBUNTU_INVENTORY_FILE) $(UBUNTU_ROLES) -l $(UBUNTU_HOST) -u $(UBUNTU_USER)
deploy:
	ssh -o StrictHostKeyChecking=no root@${HOST} -p ${PORT} 'df -h'