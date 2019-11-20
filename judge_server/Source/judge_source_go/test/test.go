package main

import (
	"os/exec"
)

func main() {
	cmd := exec.Command("bash", "-c", "./a", "<", "in.txt")
	out, err := cmd.Output()
	if err != nil {

	}
	println(string(out))
}
