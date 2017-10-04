/*
 * randomInsert.c
 * 
 * Copyright 2017 Unknown <loic@loic-ThinkPad-T450s>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define LENGTH 30

void rand_str(char *dest, size_t length) {
    char charset[] = "0123456789"
                     "abcdefghijklmnopqrstuvwxyz"
                     "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    for(int i=0; i<length;i++) {
        size_t index = ((double) rand()) / RAND_MAX * (sizeof charset - 1);
        dest[i] = charset[index];
    }
    dest[length] = '\0';
}

int main(int argc, char **argv)
{
	const char* const file  = "insertRandom.sql"    ;
	FILE* f = fopen( file, "w");
	FILE* fname = fopen("names","r");
	
	/*
	 * USERS
	 */
	for(int i =0 ; i<30; i++){
		char email[LENGTH+1];
		rand_str(email,LENGTH);
		email[LENGTH] = '\0';
		
		char name[LENGTH+1];
		fscanf(fname,"%s",name);

		
		int phone = rand();
		
		char creditCard[LENGTH+1];
		rand_str(creditCard,LENGTH);
		creditCard[LENGTH] = '\0';

		
		char password[LENGTH+1];
		rand_str(password,LENGTH);
		password[LENGTH] = '\0';

		
		fprintf(f,
			"INSERT INTO client VALUES(%s,%s,%d,%s,%s);\n",
			email,
			name,
			phone,
			creditCard,
			password);
	}
	
	/*
	 * CARS
	 */
	fclose(f);
	return 0;
}

