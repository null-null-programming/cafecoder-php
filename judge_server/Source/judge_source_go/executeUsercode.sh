if [ $# -ne 2 ]; then
    echo "few or much args.need 2 args." 1>&2
    exit 1
fi


ts=$(date +%s%N)

case $1 in
    0 ) timeout 3 ./cafecoderUsers/$2/Main.out > cafecoderUsers/$2/userStdout.txt 2> cafecoderUsers/$2/userStderr.txt;;#c11
    1 ) timeout 3 ./cafecoderUsers/$2/Main.out > cafecoderUsers/$2/userStdout.txt 2> cafecoderUsers/$2/userStderr.txt;;#c++17
    2 ) timeout 3 java -cp ./cafecoderUsers/$2/ Main > cafecoderUsers/$2/userStdout.txt 2> cafecoderUsers/$2/userStderr.txt;;#java8
    3 ) timeout 3 python3 /cafecoderUsers/$2/Main.py > cafecoderUsers/$2/userStdout.txt 2> cafecoderUsers/$2/userStderr.txt;;#python3
    4 ) timeout 3 mono ./cafecoderUsers/$2/Main.cs > cafecoderUsers/$2/userStdout.txt 2> cafecoderUsers/$2/userStderr.txt;;#c#
esac

tt=$((($(date +%s%N) - $ts)/1000000))
echo "$tt" > cafecoderUsers/$2/userTime.txt