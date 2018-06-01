# importing
from random import randint

# --- config ---
# throwing command
throwC = "th"
# quiting command
quitC = "kill"
# set dice comand
diceC = "set"
# --- end config ---

# setting up the program
diceamount = 1
print("type '",throwC,"' to throw the dice.")
print("type '",quitC,"' to end the game.")
print("type '",diceC, "' to set the amount of dice.")

# the main loop the program will be running in
running = True
while running:
    awnser = input()
    # throwing the dice
    if awnser == throwC:
        print("your dice landed on:", randint(0, 6 * diceamount))
    # quiting the program
    if awnser == quitC:
        running = False
    # setting the amount of dice in the program
    if awnser == diceC:
        print("how many do you want?")
        tempAmount = int(input())
        diceamount = tempAmount
        if diceamount == tempAmount:
            print("dice amount no set to:",diceamount)
        else:
            print("something went wrong.")
