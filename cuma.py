while True:
    try:
        n, k, m = map(int, input().split())
    except:
        break

    dp = [[0]*(k+1) for i in range(n+1)]

    dp[0][0] = 1

    for i in range(1, n+1):
        for j in range(1, k+1):
            for x in range(1, min(m, i)+1):
                dp[i][j] += dp[i-x][j-1]
                print(f"{i} {j} , {i-x} {j-1}")
                print(dp)
    print(dp[n][k])