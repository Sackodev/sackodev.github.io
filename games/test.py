import time, math
import sys, select
start = time.perf_counter()
time_count = 0
cookies = 0
while True:
	print("Cookies:", cookies)
	print("Time since:", math.floor(time.perf_counter() - start), "sec")
	i, o, e = select.select( [sys.stdin], [], [], 1 )
	if i:
		sys.stdin.readline()
		print("Cool")
	else:
		print("Lame")
	time_since = math.floor(time.perf_counter() - start)
	if time_since > time_count:
		loops = time_since - time_count
		time_count = time_since
		while loops > 0:
			cookies += 1
			loops -= 1
	