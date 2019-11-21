package main

import "time"

func main() {
	start := time.Now()
	for i := 0; i < 1000000000; i++ {

	}
	end := time.Now()
	println(end.Sub(start).Milliseconds(), "[ms]")

}
