from faker import Faker 

import names
import random
import string
import calendar


# Initialize the global faker object.
fake = Faker()


# File writer.
fileWriter = open("employee_data.txt", "w")

# Output buffer.
fileOutputList = []


#
# Generates a random address using Faker data.
# Since faker.address() has a new-line in the data,
# I don't want to use that function.
#
def getRandomAddress():
    address = ""
    
    address += fake.street_address() + ', '
    address += fake.city() + ', '
    address += fake.state_abbr(include_territories=False) + ' '
    address += fake.zipcode()
    
    return address


#
# Generates a random birthdate between 1940 and 1999.
# If you want to modify these, be my guest.
#
def getRandomBirthdate():
  MAX_YEAR = 1999
  MIN_YEAR = 1940

  MAX_MONTH = 12
  MIN_MONTH = 1

  MAX_DAY = 31
  MIN_DAY = 1

  #'yyyy-mm-dd'
  year = random.randint(MIN_YEAR, MAX_YEAR)
  month = random.randint(MIN_MONTH, MAX_MONTH)

  MAX_DAY =  calendar.monthrange(year, month)[1]

  day = random.randint(MIN_DAY, MAX_DAY)

  return "" + str(year) + "-{:02d}-{:02d}".format(month,day);


#
# Generates a random relationship status for a given gender.
# Pass the string 'female' or 'male' to get a corresponding
# relationship (so as to prevent things like Joe Bob the male
# is the daughter of Suzie Salad).
#
def getRandomRelationship(gender):
  possibleMaleRelationship = [
    "Father",
    "Father-In-Law",
    "Brother",
    "Half-Brother",
    "Step-Brother",
    "Grandfather",
    "Son",
    "Great-Grandfather",
    "Uncle",
    "Great-Uncle",
    "Cousin"
  ]

  possibleFemaleRelationship = [
    "Mother",
    "Mother-In-Law",
    "Sister",
    "Half-Sister",
    "Step-Sister",
    "Grandmother",
    "Daughter",
    "Great-Grandmother",
    "Aunt",
    "Great-Aunt",
    "Cousin"
  ]

  if gender == 'female':
    return possibleFemaleRelationship[random.randint(0, len(possibleFemaleRelationship) - 1)]
  else:
    return possibleMaleRelationship[random.randint(0, len(possibleMaleRelationship) - 1)]


# Generates either 'male' or 'female' to be used
# when generating a random relationship.
def getRandomGender():
  gender = random.randint(0, 1)

  if gender == 0:
    return 'female'
  else:
    return 'male'


def main():
  amtNames = 5000
  table = "Employee"
  minits = string.ascii_uppercase
  for i in range(amtNames):

      randSSN = str(random.randrange(100000000,999999999))
      randGender = getRandomGender()
      randFName = names.get_first_name(gender=randGender)
      randLName = names.get_last_name()
      randMInit = random.choice(minits)            
      randAddress = fake.address()

      fileOutputList.append(createCSV(randSSN, randFName, randMInit, randLName, getRandomBirthdate(), getRandomAddress()) + '\n')
      
  fileWriter.writelines(fileOutputList)
  fileWriter.close()
    

# Creates a string of Semicolon-Separated Values. We 
# use semi-colons instead of commas because the addresses 
# have commas in them.
def createCSV(*insertArgs):
  argLen = len(insertArgs)

  ssvString = ""

  for i, attribute in enumerate(insertArgs):
    if i == argLen - 1:
      ssvString += "\"" + attribute + "\""
    else:
      ssvString += "\"" + attribute + "\"" + ", "
  
  return ssvString

#
# Creates the INSERT INTO <table> VALUES(<args>);
# query with an unspecified amount of arguments 
# so you can pass any amount that you want into the 
# function and it'll still work :D
#
def createInsertQuery(table, *insertArgs):
  argLen = len(insertArgs)

  insertQuery = "INSERT INTO " + table + " VALUES("

  for i, attribute in enumerate(insertArgs):
    # If we're on the last element, go ahead and close 
    # the query off.
    if i == argLen - 1:
      insertQuery += "\"" + str(attribute) + "\");"
    else:
      insertQuery += "\"" + str(attribute) + "\", "

  return insertQuery

main()