# making varibles and arrays
import time as T
import os
import sys


counter = 0
allChar = []
passwordCheck = ['']
lenth = 0;
characterToGetList = [0]
lenthCheck = 0
passwordCracked = False
start = False
fastmodeStatus = "off" #this is to make the menu more fun
fastMode = False
# the menu allowing the user to change some stuff
while not start:

    os.system("cls")
    print("menu")
    print("----------")
    print("1:start") # to start the program
    print("2:fast mode | turend: " + fastmodeStatus) # to turn on/off fastmode
    print("3:quit")

    menucoice = input()

    if menucoice == '1':
        start = True
    if menucoice == '2':
        os.system("cls")
        print("this allows this program use all the cores of your cpu")
        print("this will heavly impact the processor of your computer")
        print("turned off by default")
        print("------------------------------------------------------")
        print("1:turn on")
        print("2:turn off")
        menucoice = input()
        if menucoice == '1':
            fastMode = True
            fastmodeStatus = "on"
        if menucoice == '2':
            fastMode = False
            fastmodeStatus = "off"
    if menucoice == '3':
        os.system("cls")
        print("are you sure")
        print("------------")
        print("1:yes")
        print("2:no")
        menucoice = input()
        if menucoice == '1':
            os.system("cls")
            sys.exit()


remove = []
os.system("cls")
start_time = T.time()
# to remove some characters that are not going to be in any passwords
idx = 0
removeCharacterList = []
for i in range(0, 32):
    removeCharacterList.append(idx)
    idx += 1
listidx = 0
for idx in enumerate(remove):
    removeCharacterList.append(remove[listidx])
    listidx += 1
print("please fill in a password")
realPassword = input()

# putting the ASCII table in a array
for character in (chr(i) for i in range(127)):
    allChar.append(character)


# removeing all the unnessecery characters
removeCounter = 0 #acts as the new list lenth and as the idx indecator for the remove list
for idx in enumerate(removeCharacterList):
    characterIndex = removeCharacterList[removeCounter]
    del allChar[characterIndex]
    removeCounter += 1

    newListLenth = 0
    for idx in enumerate(allChar):
        newListLenth += 1
passwordCracked = False

# main body of the script
while not passwordCracked:

    # checking if we've done all the characters
    for idx in enumerate(characterToGetList):
        if newListLenth in characterToGetList:
            # checking wich index it is
            index = characterToGetList.index(newListLenth)
            # checking if it is the first entry
            if index == 0:
                counter = 0 #this counter makes it so the first entry increases

            # checking if it's the last entry of the array
            # if yes adding a new entry and setting the last one to 0
            if index == lenthCheck:
                characterToGetList.append(0)
                passwordCheck.append('')
                lenthCheck += 1
                characterToGetList[index] = 0

            # if no setting the that value to 0 and increasing the next by 1
            else:
                characterToGetList[index] = 0
                index += 1
                characterToGetList[index] += 1

    arraycounter = 0
    # getting the character from the allChar array and putting it in the passwordCheck array
    for idx in enumerate(characterToGetList):
        characterToGet = characterToGetList[arraycounter]
        character = allChar[characterToGet]
        passwordCheck[arraycounter] = character
        arraycounter += 1


    password = ''.join(passwordCheck)
    print(password) # printing out the password for the looks !!is alot slower!!
    # checking the password
    if password == realPassword:
        passwordCracked = True
    else:
        counter = counter + 1
        characterToGetList[0] = counter
        if not fastMode:
            T.sleep(0.0000000000001)



print("the password is: " + password)
print("have a nice day")
print("--- it took seconds %s ---" % (T.time() - start_time))
print("press enter to exit")
input()
