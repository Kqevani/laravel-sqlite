# Doctor Network API

1. Install the task file on root dir of project (outside docker) (https://taskfile.dev/installation/)
2. Run docker service and then run in the console:
   ```
   task init
   ```
3. Hit the API endpoint:
    - Without YOE filter:
      http://127.0.0.1:80/api/doctor/network-aggregates/56
    - With YOE filter:
      http://127.0.0.1:80/api/doctor/network-aggregates/56?min_yoe=1&max_yoe=10
